package com.example.loadimage;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ComicFragment extends Fragment {
    ListView lv;
    ArrayList<Comic> comicArrayList;
    ComicAdapter adapter;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.list_comic,container,false);
        lv = (ListView) view.findViewById(R.id.listView);
        comicArrayList = new ArrayList<>();

        adapter = new ComicAdapter(R.layout.row_comics,getContext(),comicArrayList);
        lv.setAdapter(adapter);

        String url = "http://192.168.1.107/do_an_tot_nghiep/admin/api/listVegetable.php";
        ReadJson(url);


        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(getActivity(),ComicActivity.class);
                intent.putExtra("title",comicArrayList.get(position).getTitle());
                intent.putExtra("author",comicArrayList.get(position).getAuthor());
                intent.putExtra("category",comicArrayList.get(position).getCategory());
                intent.putExtra("imgComic",comicArrayList.get(position).getImage());

                startActivity(intent);

            }
        });

        return view;
    }

    private void ReadJson(String url)
    {
        RequestQueue queue = Volley.newRequestQueue(getActivity());
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null,
                new Response.Listener<JSONArray>() {
                    @Override
                    public void onResponse(JSONArray response) {
                        for(int i = 0 ; i< response.length() ; i++){
                            try {
                                JSONObject obj = response.getJSONObject(i);
                                Log.d("tagg",obj.toString());
                                comicArrayList.add(new Comic(
                                        obj.getString("image_giong"),
                                        obj.getString("name"),
                                        obj.getString("nha_cung_cap"),
                                        obj.getString("ngay_trong")
                                ));

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                            adapter.notifyDataSetChanged();

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), error.toString(),Toast.LENGTH_SHORT).show();
                    }
                });
        queue.add(jsonArrayRequest);
    }

}
