package com.example.doantotnghiep.pattern;


import com.example.doantotnghiep.adapter.FarmAdapter;
import com.example.doantotnghiep.model.Farm;

import java.util.List;

public class ListenerFarms implements ListenerDataInterface{
    FarmAdapter farmAdapter;
    @Override
    public void notifyDataGetSuccess(List<?> obj) {
        farmAdapter.getData().addAll((List<Farm>)obj);
        farmAdapter.notifyDataSetChanged();
    }
    public ListenerFarms(FarmAdapter farmAdapter){
        this.farmAdapter = farmAdapter;
    }
}
