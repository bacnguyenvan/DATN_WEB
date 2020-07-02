package com.example.doantotnghiep;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.os.Bundle;
import android.widget.TextView;

import com.example.doantotnghiep.adapter.VegetableAdapter;
import com.example.doantotnghiep.constant.UrlConstant;
import com.example.doantotnghiep.model.Vegetable;
import com.example.doantotnghiep.pattern.ListenerDataInterface;
import com.example.doantotnghiep.pattern.ListenerVegetableData;
import com.example.doantotnghiep.utils.CommonActivityUtil;
import com.example.doantotnghiep.utils.RestApiUtil;


public class MainActivity extends CommonActivityUtil {
    public static final String ID_ITEM = "ID_ITEM";
    public static TextView txtDisplayNoneData;
    RecyclerView recyclerView;
    VegetableAdapter vegetableAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        String idFarm = getIntent().getStringExtra(ID_ITEM);
        txtDisplayNoneData = findViewById(R.id.txtNoVegetables);
        // toolbar
        setToolbar("Vegetables", "Menu");
        // recycle view
        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        vegetableAdapter = new VegetableAdapter(this);
        recyclerView.setAdapter(vegetableAdapter);
        // register lister event data
        ListenerDataInterface listenerVegetable = new ListenerVegetableData(vegetableAdapter);
        RestApiUtil.getAllData(UrlConstant.urlAllVegetaleOfFarm + idFarm, MainActivity.this,listenerVegetable, Vegetable.class);
    }
}
