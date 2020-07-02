package com.example.doantotnghiep;

import android.os.Bundle;

import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.adapter.FarmAdapter;
import com.example.doantotnghiep.constant.UrlConstant;
import com.example.doantotnghiep.model.Farm;
import com.example.doantotnghiep.pattern.ListenerDataInterface;
import com.example.doantotnghiep.pattern.ListenerFarms;
import com.example.doantotnghiep.utils.CommonActivityUtil;
import com.example.doantotnghiep.utils.RestApiUtil;

public class FarmActivity extends CommonActivityUtil {
    RecyclerView recyclerView;
    FarmAdapter farmAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_farm);
        // toolbar
        setToolbar("Farms", "Menu");
        // recycle view
        // register lister event data
        recyclerView = findViewById(R.id.recyclerViewFarm);
        recyclerView.setLayoutManager(new GridLayoutManager(this, 2));
        farmAdapter = new FarmAdapter(this);
        recyclerView.setAdapter(farmAdapter);
        ListenerDataInterface listenerFarms = new ListenerFarms(farmAdapter);
        RestApiUtil.getAllData(UrlConstant.urlAllFarm, FarmActivity.this, listenerFarms, Farm.class);
    }
}
