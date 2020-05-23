package com.example.doantotnghiep.pattern;
import android.util.Log;
import com.example.doantotnghiep.adapter.VegetableAdapter;

import java.util.List;

public class ListenerVegetableData implements ListenerDataInterface{
    private VegetableAdapter vegetableAdapter;
    @Override
    public void notifyDataGetSuccess(Object vegetables) {
        Log.d("tagg",vegetables.toString());
        //vegetableAdapter.getData().addAll((List)vegetables);
        //vegetableAdapter.notifyDataSetChanged();
    }
    public ListenerVegetableData(VegetableAdapter vegetableAdapter){
        this.vegetableAdapter = vegetableAdapter;
    }
}
