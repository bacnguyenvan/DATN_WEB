package com.example.loadimage;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.loadimage.Fragment.ThucDonFragment;
import com.google.android.material.navigation.NavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    FragmentManager fragmentManager;
    ImageView btnMenu;
    NavigationView navigationView;
    DrawerLayout drawerLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btnMenu = (ImageView) findViewById(R.id.btnMenu);
        navigationView = (NavigationView) findViewById(R.id.navigationView);
        drawerLayout = (DrawerLayout) findViewById(R.id.drawerLayout);

        fragmentManager = getSupportFragmentManager();
        showListComic();

        btnMenu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                drawerLayout.openDrawer(navigationView);
            }
        });

        navigationView.setNavigationItemSelectedListener(this);

    }

    private void showListComic()
    {
        FragmentTransaction transaction = fragmentManager.beginTransaction();
        ComicFragment fragment = new ComicFragment();
        transaction.replace(R.id.frContent,fragment);
        transaction.commit();

    }


    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();
        navigationView.setCheckedItem(id);
        Log.d("id: ", String.valueOf(id));
        switch (id){
            case R.id.itTrangChu:
                Toast.makeText(MainActivity.this,"Trang chu",Toast.LENGTH_SHORT).show();
                showListComic();
                drawerLayout.closeDrawers();
                break;
            case R.id.itThucDon:

                showFood();
                drawerLayout.closeDrawers();
                break;
            case R.id.itNhanVien:
                Toast.makeText(MainActivity.this,"Nhan vien",Toast.LENGTH_SHORT).show();
                break;
            case R.id.itSetting:
                Toast.makeText(MainActivity.this,"Setting",Toast.LENGTH_SHORT).show();
                break;
        }
        return false;
    }

    public void showFood()
    {
        FragmentTransaction transaction = fragmentManager.beginTransaction();
        ThucDonFragment thucDonFragment = new ThucDonFragment();
        transaction.replace(R.id.frContent,thucDonFragment);
        transaction.commit();




    }
}
