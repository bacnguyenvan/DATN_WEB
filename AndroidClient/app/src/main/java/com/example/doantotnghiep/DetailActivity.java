package com.example.doantotnghiep;

import android.content.Context;
import android.os.Bundle;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.ViewFlipper;
import com.example.doantotnghiep.constant.UrlConstant;
import com.example.doantotnghiep.model.DetailVegetable;
import com.example.doantotnghiep.pattern.ListenerDataInterface;
import com.example.doantotnghiep.pattern.ListenerDetailVegetableData;
import com.example.doantotnghiep.utils.CommonActivityUtil;
import com.example.doantotnghiep.utils.RestApiUtil;
import com.google.android.gms.maps.SupportMapFragment;

public class DetailActivity extends CommonActivityUtil {
    public static final String ID_ITEM = "ID_ITEM";
    public static Context context;
    public static ViewFlipper viewFlipper;
    public static TextView txtNameDetail;
    public static TextView txtDetailPrice;
    public static TextView txtPlantDate;
    public static TextView txtHarvestDate;
    public static TextView txtNodata;
    public static SupportMapFragment mapFragment;
    public static LinearLayout linearProcedure;
    public static TextView txtNoneProcedure;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        context = getApplicationContext();
        setContentView(R.layout.activity_detail);
        // toolbar
        setToolbar("Vegetable", "Detail");
        // find id view
        findIdView();
        // register event get data
        String id = getIntent().getStringExtra(DetailActivity.ID_ITEM);
        mapFragment =
                (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.google_map);
        ListenerDataInterface listenerVegetable = new ListenerDetailVegetableData();
        RestApiUtil.getById(UrlConstant.urlDetailVegetale, id,this,listenerVegetable, DetailVegetable.class );
    }
    private void findIdView() {
        viewFlipper = findViewById(R.id.viewFilperHarvestImage);
        txtNameDetail = findViewById(R.id.txtNameDetail);
        txtDetailPrice = findViewById(R.id.txtDetailPrice);
        txtPlantDate = findViewById(R.id.txtPlantDate);
        txtHarvestDate = findViewById(R.id.txtHarvestDate);
        txtNodata = findViewById(R.id.txtNodata);
        linearProcedure = findViewById(R.id.linearProcedure);
        txtNoneProcedure = findViewById(R.id.txtNoneProcedure);
    }

}
