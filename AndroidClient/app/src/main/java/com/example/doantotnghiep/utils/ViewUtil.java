package com.example.doantotnghiep.utils;

import android.content.Context;
import android.widget.ImageView;
import android.widget.ViewFlipper;

import com.example.doantotnghiep.DetailActivity;
import com.example.doantotnghiep.constant.UrlConstant;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

public class ViewUtil {
    public static void addImagesToViewFliper(Context context, List<String> nameImages, ViewFlipper viewFlipper){
        List<ImageView> list = new ArrayList<>();
        for(String name : nameImages){
            ImageView imageView = new ImageView(DetailActivity.context);
            imageView.setScaleType(ImageView.ScaleType.FIT_XY);
            Picasso.with(context).load(UrlConstant.urlImageVegetale + name)
                    .into(imageView);
            list.add(imageView);
        }
        for(ImageView imageView : list)
            viewFlipper.addView(imageView);
        if (list.size() > 1) {
            viewFlipper.setFlipInterval(4000);
            viewFlipper.startFlipping();
            //animation
            viewFlipper.setInAnimation(DetailActivity.context, android.R.anim.fade_in);
            viewFlipper.setOutAnimation(DetailActivity.context, android.R.anim.fade_out);
        }
    }
}
