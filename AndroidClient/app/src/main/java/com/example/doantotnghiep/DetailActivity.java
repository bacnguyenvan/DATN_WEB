package com.example.doantotnghiep;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ViewFlipper;
import com.example.doantotnghiep.constant.AppConstant;
import com.example.doantotnghiep.model.DetailVegetable;
import com.example.doantotnghiep.pattern.ListenerDataInterface;
import com.example.doantotnghiep.pattern.ListenerDetailVegetableData;
import com.example.doantotnghiep.utils.RestApiUtil;
import com.github.mikephil.charting.charts.BarChart;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

public class DetailActivity extends AppCompatActivity {
    public static final String ID_ITEM = "ID_ITEM";
    public static Context context;
    public static ViewFlipper viewFlipper;
    public static TextView txtNameDetail;
    public static TextView txtDetailPrice;
    public static TextView txtProvider;
    public static TextView txtLocationProvider;
    public static TextView txtDateSelectBreed;
    public static ImageView breedImage;
    public static TextView txtGrower;
    public static TextView txtPlantLocation;
    public static TextView txtPlantDate;
    public static TextView txtHarvestDate;
    public static TextView txtNumber;
    public static BarChart barChart;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        context = getApplicationContext();
        setContentView(R.layout.activity_detail);
        // toolbar
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("");
        setSupportActionBar(toolbar);
        // find id view
        findIdView();
        // register event get data
        String id = getIntent().getStringExtra(DetailActivity.ID_ITEM);
        ListenerDataInterface listenerVegetable = new ListenerDetailVegetableData();
        RestApiUtil.getById(AppConstant.urlDetail,id,this,listenerVegetable, DetailVegetable.class );
    }

    private void findIdView() {
        viewFlipper = findViewById(R.id.viewFilperHarvestImage);
        txtNameDetail = findViewById(R.id.txtNameDetail);
        txtDetailPrice = findViewById(R.id.txtDetailPrice);
        txtProvider = findViewById(R.id.txtProvider);
        txtLocationProvider = findViewById(R.id.txtLocationProvider);
        txtDateSelectBreed = findViewById(R.id.txtDateSelectBreed);
        breedImage = findViewById(R.id.breedImage);
        txtGrower = findViewById(R.id.txtGrower);
        txtPlantLocation = findViewById(R.id.txtPlantLocation);
        txtPlantDate = findViewById(R.id.txtPlantDate);
        txtHarvestDate = findViewById(R.id.txtHarvestDate);
        txtNumber = findViewById(R.id.txtNumber);
        barChart = findViewById(R.id.chartClimate);
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_home,menu);
        return super.onCreateOptionsMenu(menu);

    }
    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        IntentIntegrator intentIntegrator = new IntentIntegrator(this);
        intentIntegrator.initiateScan();
        return super.onOptionsItemSelected(item);
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        IntentResult result = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
        if(result != null) {
            if(result.getContents() == null) {
                Toast.makeText(this, "Not found!", Toast.LENGTH_LONG).show();
            } else {
                ListenerDataInterface listenerVegetable = new ListenerDetailVegetableData();
                RestApiUtil.getById(AppConstant.urlDetail,result.getContents(),this,listenerVegetable, DetailVegetable.class );
            }
        } else {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }
}
