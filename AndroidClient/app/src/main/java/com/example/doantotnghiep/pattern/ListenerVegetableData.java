package com.example.doantotnghiep.pattern;

import com.example.doantotnghiep.adapter.VegetableAdapter;
import com.example.doantotnghiep.model.Vegetable;

import java.util.List;

public class ListenerVegetableData implements ListenerDataInterface{
    private VegetableAdapter vegetableAdapter;
    @Override
    public void notifyDataGetSuccess(List<? extends Vegetable> vegetables) {
        vegetableAdapter.getData().addAll(vegetables);
        vegetableAdapter.notifyDataSetChanged();
    }
    public ListenerVegetableData(VegetableAdapter vegetableAdapter){
        this.vegetableAdapter = vegetableAdapter;
    }
}
