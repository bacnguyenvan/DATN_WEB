package com.example.loadimage;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

public class ComicActivity extends AppCompatActivity {
    TextView tvtitle, tvauthor, tvcategory;
    ImageView imgComic;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_comic);
        map();

        Intent intent = getIntent();
        tvtitle.setText(intent.getStringExtra("title"));
        tvauthor.setText(intent.getStringExtra("author"));
        tvcategory.setText(intent.getStringExtra("category"));
//        imgComic.setImageResource(R.drawable.ic_launcher_background);
        String url = "http://172.17.191.209/do_an_tot_nghiep/admin/public/uploads/rau/";
        Picasso.with(this).load(url+intent.getStringExtra("imgComic")).into(imgComic);

    }
    private void map()
    {
        tvtitle = (TextView) findViewById(R.id.tvTitle);
        tvauthor = (TextView) findViewById(R.id.tvAuthor);
        tvcategory = (TextView) findViewById(R.id.tvCategory);
        imgComic = (ImageView) findViewById(R.id.imgComic);

    }
}
