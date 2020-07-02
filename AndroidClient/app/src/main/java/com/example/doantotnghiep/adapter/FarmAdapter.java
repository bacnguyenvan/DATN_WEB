package com.example.doantotnghiep.adapter;

import android.content.Context;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.DetailActivity;
import com.example.doantotnghiep.MainActivity;
import com.example.doantotnghiep.R;
import com.example.doantotnghiep.constant.AppConstant;
import com.example.doantotnghiep.constant.UrlConstant;
import com.example.doantotnghiep.model.Farm;
import com.example.doantotnghiep.model.Location;
import com.squareup.picasso.Picasso;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class FarmAdapter extends RecyclerView.Adapter<FarmHolder> {
    Context c;
    List<Farm> farms = new ArrayList<>();
    public FarmAdapter(Context c) {
        this.c = c;
    }


    @NonNull
    @Override
    public FarmHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.carditemfarm,null);
        return new FarmHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final FarmHolder holder, int position) {
        String avatar = farms.get(position).getAvatar();
        String name = farms.get(position).getName();
        holder.maTrangTrai = farms.get(position).getMa_trang_trai();
        holder.txtName.setText(name);
        if(!avatar.equals("") && avatar != null){
            Picasso.with(c).load(UrlConstant.urlImageFarm + avatar).into(holder.imageView);
        }
        List<Location> locations = farms.get(position).getLocation();
        if(locations != null && locations.size() > 0){
            try {
                double longitude = Double.parseDouble(locations.get(0).getKinh_do());
                double latitude = Double.parseDouble(locations.get(0).getVi_do());
                Geocoder geocoder = new Geocoder(c, Locale.getDefault());
                List<Address> address = geocoder.getFromLocation(latitude,
                        longitude, 1);
                String txtAddress = address.get(0).getAddressLine(0);
                int lastIndex = txtAddress.lastIndexOf(",");
                txtAddress = txtAddress.substring(0, lastIndex);
                holder.txtAddress.setText(txtAddress);
                // caculate distance
                android.location.Location farmLocation = new android.location.Location("");
                farmLocation.setLatitude(latitude);
                farmLocation.setLongitude(longitude);

                android.location.Location currentLocation = new android.location.Location("");
                currentLocation.setLatitude(AppConstant.latitude);
                currentLocation.setLongitude(AppConstant.longitude);
                //
                float distance = currentLocation.distanceTo(farmLocation)/1000;
                holder.txtDistance.setText(Math.floor(distance*100)/100 + "km");
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        holder.setItemClickListener(new ItemClickListener() {
            @Override
            public void onItemClickListener(View v, int position) {
                Intent intent = new Intent(c, MainActivity.class);
                intent.putExtra(MainActivity.ID_ITEM, holder.maTrangTrai);
                c.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return farms.size();
    }
    public List<Farm> getData(){
        return farms;
    }
}
