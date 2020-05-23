package com.example.doantotnghiep.model;

public class Vegetable {
    public String id;
    public String name;
    public String provideLocation;
    public String price;
    public String harvestImage;

    @Override
    public String toString() {
        return "Vegetable{" +
                "id='" + id + '\'' +
                ", name='" + name + '\'' +
                ", provideLocation='" + provideLocation + '\'' +
                ", price='" + price + '\'' +
                ", harvestImage='" + harvestImage + '\'' +
                '}';
    }
}
