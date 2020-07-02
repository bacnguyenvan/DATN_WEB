package com.example.doantotnghiep.pattern;
import android.graphics.Color;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;
import com.example.doantotnghiep.DetailActivity;
import com.example.doantotnghiep.model.DetailVegetable;
import com.example.doantotnghiep.model.Location;
import com.example.doantotnghiep.model.Procedure;
import com.example.doantotnghiep.utils.ViewUtil;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import java.util.Arrays;
import java.util.List;

public class ListenerDetailVegetableData implements ListenerDataInterface, OnMapReadyCallback {
    public Location location;
    @Override
    public void notifyDataGetSuccess(List<?> vegetables) {
        DetailVegetable detailVegetable = (DetailVegetable) vegetables.get(0);
        DetailActivity.txtNameDetail.setText(detailVegetable.name);
        DetailActivity.txtDetailPrice.setText(detailVegetable.price);
        DetailActivity.txtHarvestDate.setText(detailVegetable.ngay_thu_hoach);
        DetailActivity.txtPlantDate.setText(detailVegetable.ngay_trong);
        // location
        location = detailVegetable.location.get(0);
        if(location != null)
            DetailActivity.mapFragment.getMapAsync(this);
        else
        {
            DetailActivity.mapFragment.setMenuVisibility(false);
            DetailActivity.txtNodata.setVisibility(View.VISIBLE);
        }
        // set Image
        if(detailVegetable.img_thu_hoach != null && detailVegetable.img_thu_hoach.length() > 0){
            ViewUtil.addImagesToViewFliper(DetailActivity.context, Arrays.asList(detailVegetable.img_thu_hoach), DetailActivity.viewFlipper);
        }
        // set procedure
        if(detailVegetable.procedure.size() > 0){
            for(Procedure x : detailVegetable.procedure){
                createProcedure(x.ten_quy_trinh, x.thoi_gian);
            }
        }
        else
            DetailActivity.txtNoneProcedure.setVisibility(View.VISIBLE);
    }

    public void createProcedure(String name, String time){
        LinearLayout parent = new LinearLayout(DetailActivity.context);
        LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.WRAP_CONTENT,
                LinearLayout.LayoutParams.WRAP_CONTENT
        );
        params.setMargins(50, 0,0,0);
        parent.setLayoutParams(params);
        parent.setOrientation(LinearLayout.HORIZONTAL);

        DetailActivity.linearProcedure.addView(parent);
        name = "-" + name + ": ";
        TextView txtName = createTextView(name, true);
        TextView txtTime = createTextView(time, false);
        parent.addView(txtName);
        parent.addView(txtTime);
    }

    private TextView createTextView(String text, boolean isName) {
        TextView txtName = new TextView(DetailActivity.context);
        txtName.setTextSize(16);
        txtName.setFontFeatureSettings("@font/roboto_bolditalic");
        if(isName)
            txtName.setTextColor(Color.parseColor("#ff9700"));
        else
            txtName.setTextColor(Color.parseColor("#ffffff"));
        txtName.setText(text);
        return txtName;
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        GoogleMap mMap = googleMap;
        LatLng latLng = new LatLng(Float.parseFloat(location.getVi_do()),
                Float.parseFloat(location.getKinh_do()));
        MarkerOptions options = new MarkerOptions().position(latLng).title("ngã tư").snippet("");
        mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(latLng, 15));
        mMap.addMarker(options);
    }
}
