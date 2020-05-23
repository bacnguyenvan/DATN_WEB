package com.example.doantotnghiep;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.Menu;
import android.widget.Toast;

import com.example.doantotnghiep.adapter.VegetableAdapter;
import com.example.doantotnghiep.constant.AppConstant;
import com.example.doantotnghiep.model.DetailVegetable;
import com.example.doantotnghiep.model.Vegetable;
import com.example.doantotnghiep.pattern.ListenerDataInterface;
import com.example.doantotnghiep.pattern.ListenerVegetableData;
import com.example.doantotnghiep.utils.RestApiUtil;
import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    VegetableAdapter vegetableAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("");
        setSupportActionBar(toolbar);
        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        vegetableAdapter = new VegetableAdapter(this,getList());
        recyclerView.setAdapter(vegetableAdapter);
    }

    @Override
    protected void onStart() {
        super.onStart();
        //RestApiUtil.findById(AppConstant.urlDetail,"12",this, DetailVegetable.class);
        ListenerDataInterface listenerVegetable = new ListenerVegetableData(vegetableAdapter);
        RestApiUtil.getAllData(AppConstant.urlAll, MainActivity.this,listenerVegetable, Vegetable.class);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_home,menu);
        return super.onCreateOptionsMenu(menu);

    }

    private List<Vegetable> getList() {
        List<Vegetable> lists = new ArrayList<>();

        Vegetable vegetable1 = new Vegetable();
        vegetable1.name = "Cà chua";
        vegetable1.price = "20.000đ";
        vegetable1.provideLocation = "Hồ Chí Minh";
        vegetable1.harvestImage = String.valueOf(R.drawable.cachua);

        Vegetable vegetable2 = new Vegetable();
        vegetable2.name = "Bí đỏ";
        vegetable2.price = "10.000đ";
        vegetable2.provideLocation = "Hà Nội";
        vegetable2.harvestImage = String.valueOf(R.drawable.bido);
//        Vegetable vegetable3 = new Vegetable();
//        vegetable3.setName("Bắp cải");
//        vegetable3.setCost("30.000đ");
//        vegetable3.setOrigin("Khánh Hòa");
//        vegetable3.setImage(R.drawable.bapcai);
//
//        Vegetable vegetable4 = new Vegetable();
//        vegetable4.setName("Cà rốt");
//        vegetable4.setCost("25.000đ");
//        vegetable4.setOrigin("Hồ Chí Minh");
//        vegetable4.setImage(R.drawable.carot);

        lists.add(vegetable1);
        lists.add(vegetable2);
//        lists.add(vegetable3);
//        lists.add(vegetable4);
        return lists;
    }
}
