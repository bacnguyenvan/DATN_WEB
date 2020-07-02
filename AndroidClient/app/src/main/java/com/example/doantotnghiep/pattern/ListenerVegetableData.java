package com.example.doantotnghiep.pattern;
import android.view.View;

import com.example.doantotnghiep.MainActivity;
import com.example.doantotnghiep.adapter.VegetableAdapter;
import com.example.doantotnghiep.model.DetailVegetable;
import java.util.List;

public class ListenerVegetableData implements ListenerDataInterface{
    private VegetableAdapter vegetableAdapter;
    @Override
    public void notifyDataGetSuccess(List<?> vegetables) {
        if(vegetables.size() > 0){
            vegetableAdapter.getData().addAll((List< DetailVegetable >)vegetables);
            vegetableAdapter.notifyDataSetChanged();
            return;
        }
        MainActivity.txtDisplayNoneData.setVisibility(View.VISIBLE);
    }
    public ListenerVegetableData(VegetableAdapter vegetableAdapter){
        this.vegetableAdapter = vegetableAdapter;
    }
}
