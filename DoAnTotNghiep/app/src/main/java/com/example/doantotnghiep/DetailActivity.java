package com.example.doantotnghiep;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.graphics.Color;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.ImageView;
import android.widget.ViewFlipper;

import com.example.doantotnghiep.model.Climate;
import com.github.mikephil.charting.charts.BarChart;
import com.github.mikephil.charting.components.XAxis;
import com.github.mikephil.charting.components.YAxis;
import com.github.mikephil.charting.data.BarData;
import com.github.mikephil.charting.data.BarDataSet;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter;
import com.github.mikephil.charting.formatter.LargeValueFormatter;


import java.util.ArrayList;
import java.util.List;

public class DetailActivity extends AppCompatActivity implements View.OnClickListener {
    ViewFlipper viewFlipper;
    BarChart barChart;
    List<Climate> dataClimates = new ArrayList<>();
    {
        dataClimates.add(new Climate("18/01","34","75"));
        dataClimates.add(new Climate("19/01","35.5","78"));
        dataClimates.add(new Climate("20/01","33","80"));
        dataClimates.add(new Climate("21/01","36.5","82"));
        dataClimates.add(new Climate("22/01","34","75"));
        dataClimates.add(new Climate("23/01","35.5","78"));
        dataClimates.add(new Climate("24/01","33","80"));
        dataClimates.add(new Climate("25/01","36.5","82"));
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("");
        setSupportActionBar(toolbar);
//        viewFlipper = findViewById(R.id.viewFilper);
//        barChart = findViewById(R.id.idChart);
        drawChart();
        addImageViewFilper();
        viewFlipper.setOnClickListener(this);
    }

    private void drawChart() {
        BarDataSet barTemperature = new BarDataSet(dataTemperature(),"Nhiệt độ");
        barTemperature.setValueTextSize(10);
        barTemperature.setColor(Color.parseColor("#F9A41A"));
        BarDataSet barHumidity = new BarDataSet(dataHumidity(),"Độ ẩm");
        barHumidity.setValueTextSize(10);
        barHumidity.setColor(Color.parseColor("#57B657"));
        BarData barData = new BarData(barTemperature,barHumidity);
        barChart.setBackgroundColor(Color.WHITE);
        barChart.setDescription(null);
        barChart.setData(barData);
        String[] date = new String[dataClimates.size()];
        for(int i = 0; i < dataClimates.size();i++)
            date[i] = dataClimates.get(i).getDate();
        float barWidth;
        float barSpace;
        float groupSpace;

        barWidth = 0.32f;
        barSpace = 0.0f;
        groupSpace = 0.36f;
        XAxis xAxis = barChart.getXAxis();
        xAxis.setGranularity(1f);
        xAxis.setGranularityEnabled(true);
        xAxis.setCenterAxisLabels(true);
        xAxis.setDrawGridLines(false);

        xAxis.setPosition(XAxis.XAxisPosition.BOTTOM);
        xAxis.setValueFormatter(new IndexAxisValueFormatter(date));
        YAxis leftAxis = barChart.getAxisLeft();
        leftAxis.setValueFormatter(new LargeValueFormatter());
        leftAxis.setDrawGridLines(true);

        int groupCount = dataClimates.size();
        barChart.getBarData().setBarWidth(barWidth);
        barChart.getXAxis().setAxisMinimum(0);
        barChart.getXAxis().setAxisMaximum(barWidth + barChart.getBarData().getGroupWidth(groupSpace, barSpace) * groupCount);
        barChart.groupBars(0, groupSpace, barSpace);
        barChart.getData().setHighlightEnabled(false);
        barChart.setVisibleXRangeMaximum(5);
        barChart.invalidate();
    }

    private List<BarEntry> dataHumidity() {
        List<BarEntry> list = new ArrayList<>();
        for(int i = 0; i < dataClimates.size(); i++)
            list.add(new BarEntry(i+1,Float.parseFloat(dataClimates.get(i).getHumidity())));
        return list;
    }

    private List<BarEntry> dataTemperature() {
        List<BarEntry> list = new ArrayList<>();
        for(int i = 0; i < dataClimates.size(); i++)
            list.add(new BarEntry(i+1,Float.parseFloat(dataClimates.get(i).getTemperature())));
        return list;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_home,menu);
        return super.onCreateOptionsMenu(menu);

    }
    private void addImageViewFilper() {
        ImageView imageView1 = new ImageView(this);
        imageView1.setScaleType(ImageView.ScaleType.FIT_XY);
        imageView1.setImageResource(R.drawable.bapcai);

        ImageView imageView2 = new ImageView(this);
        imageView2.setScaleType(ImageView.ScaleType.FIT_XY);
        imageView2.setImageResource(R.drawable.bido);

        List<ImageView> list = new ArrayList<>();
        list.add(imageView1);
        list.add(imageView2);
        for(ImageView imageView : list)
            viewFlipper.addView(imageView);

        if (list.size() != 1) {
            viewFlipper.setFlipInterval(4000);
            viewFlipper.startFlipping();
        }

        //animation
        viewFlipper.setInAnimation(this, android.R.anim.fade_in);
        viewFlipper.setOutAnimation(this, android.R.anim.fade_out);
    }

    @Override
    public void onClick(View v) {

    }
}
