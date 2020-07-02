package com.example.doantotnghiep.adapter;

import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.R;

public class FarmHolder extends RecyclerView.ViewHolder implements  View.OnClickListener {
    public ImageView imageView;
    public TextView txtName;
    public TextView txtDistance;
    public TextView txtAddress;
    public String maTrangTrai;
    ItemClickListener itemClickListener;
    public FarmHolder(@NonNull View itemView) {
        super(itemView);
        imageView = itemView.findViewById(R.id.imgFarm);
        txtName = itemView.findViewById(R.id.txtNameFarm);
        txtDistance = itemView.findViewById(R.id.txtDistanceFarm);
        txtAddress = itemView.findViewById(R.id.txtAddress);
        itemView.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        this.itemClickListener.onItemClickListener(v,getLayoutPosition());
    }
    public void setItemClickListener(ItemClickListener itemClickListener) {
        this.itemClickListener = itemClickListener;
    }
}
