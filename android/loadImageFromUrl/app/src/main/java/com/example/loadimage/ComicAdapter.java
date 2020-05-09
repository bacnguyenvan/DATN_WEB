package com.example.loadimage;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class ComicAdapter extends BaseAdapter {
    int layout;
    Context context;
    ArrayList<Comic> comicArrayList;

    public ComicAdapter(int layout, Context context, ArrayList<Comic> comicArrayList) {
        this.layout = layout;
        this.context = context;
        this.comicArrayList = comicArrayList;
    }

    @Override
    public int getCount() {
        return comicArrayList.size();
    }

    @Override
    public Object getItem(int position) {
        return null;
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    public class ViewHolder{
        TextView title, author , category;
        ImageView imgComic;
    }
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        ViewHolder holder;
        if(convertView == null){
            // convert layout to view;
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(layout,null);

            //map
            holder = new ViewHolder();
            holder.title = (TextView) convertView.findViewById(R.id.tvTitle);
            holder.author = (TextView) convertView.findViewById(R.id.tvAuthor);
            holder.category = (TextView) convertView.findViewById(R.id.tvCategory);
            holder.imgComic = (ImageView) convertView.findViewById(R.id.imgComic);

            convertView.setTag(holder);
        }else{
            holder = (ViewHolder) convertView.getTag();
        }

        //
        Comic comic = comicArrayList.get(position);
//        holder.imgComic.setImageResource(comic.getImage());
        holder.title.setText(comic.getTitle());
        holder.author.setText(comic.getAuthor());
        holder.category.setText(comic.getCategory());
        String url = "http://192.168.144.2/do_an_tot_nghiep/admin/public/uploads/rau/";
        Picasso.with(context).load(url+comic.getImage()).into(holder.imgComic);

        return convertView;
    }
}
