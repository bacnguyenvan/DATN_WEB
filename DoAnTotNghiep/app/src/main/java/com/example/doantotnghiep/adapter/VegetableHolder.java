package com.example.doantotnghiep.adapter;

import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.R;

import de.hdodenhof.circleimageview.CircleImageView;

public class VegetableHolder extends RecyclerView.ViewHolder implements  View.OnClickListener{
    TextView txtName;
    TextView txtCost;
    TextView txtOrigin;
    CircleImageView imgImage;
    ItemClickListener itemClickListener;
    public VegetableHolder(@NonNull View itemView) {
        super(itemView);
        txtName = itemView.findViewById(R.id.txtName);
        txtOrigin = itemView.findViewById(R.id.txtOrigin);
        txtCost = itemView.findViewById(R.id.txtCost);
        imgImage = itemView.findViewById(R.id.imgImage);
        itemView.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        this.itemClickListener.onItemClickListener(v,getLayoutPosition());
    }
    public ItemClickListener getItemClickListener() {
        return itemClickListener;
    }

    public void setItemClickListener(ItemClickListener itemClickListener) {
        this.itemClickListener = itemClickListener;
    }
}
