package com.example.doantotnghiep.adapter;

import android.view.View;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.R;

import de.hdodenhof.circleimageview.CircleImageView;

public class VegetableHolder extends RecyclerView.ViewHolder implements  View.OnClickListener{
    TextView txtName;
    TextView txtPrice;
    TextView txtProvideLocation;
    String idItem;
    CircleImageView imgHarvestImage;
    ItemClickListener itemClickListener;
    public VegetableHolder(@NonNull View itemView) {
        super(itemView);
        txtName = itemView.findViewById(R.id.txtName);
        txtProvideLocation = itemView.findViewById(R.id.txtProvideLocation);
        txtPrice = itemView.findViewById(R.id.txtPrice);
        imgHarvestImage = itemView.findViewById(R.id.imgHarvestImage);
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
