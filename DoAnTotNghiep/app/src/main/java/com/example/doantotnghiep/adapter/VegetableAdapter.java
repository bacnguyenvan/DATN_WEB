package com.example.doantotnghiep.adapter;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.doantotnghiep.DetailActivity;
import com.example.doantotnghiep.R;
import com.example.doantotnghiep.model.Vegetable;

import java.util.ArrayList;
import java.util.List;

public class VegetableAdapter extends RecyclerView.Adapter<VegetableHolder>  {
    Context c;
    List<Vegetable> vegetableList = new ArrayList<>();
    public VegetableAdapter(Context c, List<Vegetable> vegetableList) {
        this.c = c;
        this.vegetableList.addAll(vegetableList);
    }

    @NonNull
    @Override
    public VegetableHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row,null);
        return new VegetableHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull VegetableHolder holder, int position) {
        int color = Color.parseColor("#fdb501");
        if(position % 4 == 1)
            color  = Color.parseColor("#FF5832");
        else if(position % 4 == 2 )
            color = Color.parseColor("#37AF57");
        else if(position % 4 == 3)
            color = Color.parseColor("#FF3F51B5");
        holder.txtName.setTextColor(color);
        holder.txtName.setText(vegetableList.get(position).name);
        holder.txtOrigin.setText(vegetableList.get(position).provideLocation);
        holder.txtCost.setText(vegetableList.get(position).price);
        holder.imgImage.setImageResource(Integer.parseInt(vegetableList.get(position).harvestImage));
        holder.setItemClickListener(new ItemClickListener() {
            @Override
            public void onItemClickListener(View v, int position) {
                Intent intent = new Intent(c, DetailActivity.class);
                c.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return vegetableList.size();
    }

    public List<Vegetable> getData(){
        return vegetableList;
    }
}
