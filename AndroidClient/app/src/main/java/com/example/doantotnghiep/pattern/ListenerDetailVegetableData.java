package com.example.doantotnghiep.pattern;
import com.example.doantotnghiep.DetailActivity;
import com.example.doantotnghiep.constant.AppConstant;
import com.example.doantotnghiep.model.Climate;
import com.example.doantotnghiep.model.DetailVegetable;
import com.example.doantotnghiep.model.Vegetable;
import com.example.doantotnghiep.utils.ChartUtil;
import com.example.doantotnghiep.utils.ViewUtil;
import com.github.mikephil.charting.data.BarEntry;
import com.squareup.picasso.Picasso;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class ListenerDetailVegetableData implements ListenerDataInterface{
    @Override
    public void notifyDataGetSuccess(List<? extends Vegetable> vegetables) {
        DetailVegetable detailVegetable = (DetailVegetable) vegetables.get(0);
        DetailActivity.txtNameDetail.setText(detailVegetable.name);
        DetailActivity.txtDateSelectBreed.setText(detailVegetable.dateSelectBreed);
        DetailActivity.txtDetailPrice.setText(detailVegetable.price);
        DetailActivity.txtGrower.setText(detailVegetable.grower);
        DetailActivity.txtHarvestDate.setText(detailVegetable.harvestDate);
        DetailActivity.txtLocationProvider.setText(detailVegetable.provideLocation);
        DetailActivity.txtPlantLocation.setText(detailVegetable.plantLocation);
        DetailActivity.txtNumber.setText(detailVegetable.number);
        DetailActivity.txtProvider.setText(detailVegetable.provider);
        DetailActivity.txtPlantDate.setText(detailVegetable.plantDate);
        // set Image
        if(detailVegetable.harvestImage != null && detailVegetable.harvestImage.length() > 0){
            ViewUtil.addImagesToViewFliper(DetailActivity.context, Arrays.asList(detailVegetable.harvestImage), DetailActivity.viewFlipper);
        }
        if(detailVegetable.breedImage != null && detailVegetable.breedImage.length() > 0){
            Picasso.with(DetailActivity.context).load(AppConstant.urlImage + detailVegetable.breedImage)
                    .into(DetailActivity.breedImage);
        }
        // draw chart
        List<BarEntry> temperatures = listTemperature(detailVegetable.climate);
        List<BarEntry> humiditis = listHumidity(detailVegetable.climate);
        List<String> dates = listDates(detailVegetable.climate);
        ChartUtil.drawBarChart(DetailActivity.barChart, temperatures, humiditis,
                dates, "Nhiệt độ", "Độ ẩm");
    }
    private List<BarEntry> listTemperature(List<Climate> climates){
        List<BarEntry> result = new ArrayList<>();
        for(int i = 0; i < climates.size(); i++)
            result.add(new BarEntry(i+1,Float.parseFloat(climates.get(i).getTemperature())));
        return result;
    }
    private List<BarEntry> listHumidity(List<Climate> climates){
        List<BarEntry> result = new ArrayList<>();
        for(int i = 0; i < climates.size(); i++)
            result.add(new BarEntry(i+1,Float.parseFloat(climates.get(i).getHumidity())));
        return result;
    }
    private List<String> listDates(List<Climate> climates){
        List<String> result = new ArrayList<>();
        for(Climate climate : climates){
            String date = climate.getDate();
            String arr[] = date.split("-");
            result.add(arr[2] + "/" + arr[1]);
        }
        return result;
    }
}
