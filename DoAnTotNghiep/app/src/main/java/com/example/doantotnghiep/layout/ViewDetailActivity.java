package com.example.doantotnghiep.layout;

import android.app.Activity;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.ViewFlipper;


import androidx.appcompat.app.AppCompatActivity;

import com.example.doantotnghiep.R;
import com.github.mikephil.charting.charts.BarChart;

public class ViewDetailActivity extends AppCompatActivity {
    public ViewFlipper viewFlipper = findViewById(R.id.viewFilperHarvestImage);
    public TextView txtNameDetail = findViewById(R.id.txtNameDetail);
    public TextView txtDetailPrice = findViewById(R.id.txtDetailPrice);
    public TextView txtProvider = findViewById(R.id.txtProvider);
    public TextView txtLocationProvider = findViewById(R.id.txtLocationProvider);
    public TextView txtDateSelectBreed = findViewById(R.id.txtDateSelectBreed);
    public ImageView breedImage = findViewById(R.id.breedImage);
    public TextView txtGrower = findViewById(R.id.txtGrower);
    public TextView txtPlantLocation = findViewById(R.id.txtPlantLocation);
    public TextView txtPlantDate = findViewById(R.id.txtPlantDate);
    public TextView txtHarvestDate = findViewById(R.id.txtHarvestDate);
    public TextView txtNumber = findViewById(R.id.txtNumber);
    public BarChart barChart = findViewById(R.id.chartClimate);

    ViewDetailActivity viewDetailActivity;
    private ViewDetailActivity(){}

    public ViewDetailActivity factory(){
        return viewDetailActivity == null ? new ViewDetailActivity() : viewDetailActivity;
    }
}
