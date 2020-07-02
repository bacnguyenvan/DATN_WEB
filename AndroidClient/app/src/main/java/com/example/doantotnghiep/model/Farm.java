package com.example.doantotnghiep.model;

import java.util.List;

public class Farm {
    private String avatar;
    private String ma_trang_trai;
    private String name;
    private List<Location> location;

    public String getAvatar() {
        return avatar;
    }

    public void setAvatar(String avatar) {
        this.avatar = avatar;
    }

    public String getMa_trang_trai() {
        return ma_trang_trai;
    }

    public void setMa_trang_trai(String ma_trang_trai) {
        this.ma_trang_trai = ma_trang_trai;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public List<Location> getLocation() {
        return location;
    }

    public void setLocation(List<Location> location) {
        this.location = location;
    }

    public Farm() {
    }

    @Override
    public String toString() {
        return "Farm{" +
                "avatar='" + avatar + '\'' +
                ", ma_trang_trai='" + ma_trang_trai + '\'' +
                ", name='" + name + '\'' +
                ", location=" + location +
                '}';
    }
}
