package com.example.doantotnghiep.model;


import java.util.ArrayList;
import java.util.List;

public class DetailVegetable extends Vegetable{
    public String provider;
    public String dateSelectBreed;
    public String breedImage;
    public String plantLocation;
    public String grower;
    public String plantDate;
    public String harvestDate;
    public String number;
    public List<Climate> climate = new ArrayList<>();

    @Override
    public String toString() {
        return "DetailVegetable{" +
                "provider='" + provider + '\'' +
                ", dateSelectBreed='" + dateSelectBreed + '\'' +
                ", breedImage='" + breedImage + '\'' +
                ", plantLocation='" + plantLocation + '\'' +
                ", grower='" + grower + '\'' +
                ", plantDate='" + plantDate + '\'' +
                ", harvestDate='" + harvestDate + '\'' +
                ", number='" + number + '\'' +
                ", climate=" + climate +
                ", id='" + id + '\'' +
                ", name='" + name + '\'' +
                ", provideLocation='" + provideLocation + '\'' +
                ", price='" + price + '\'' +
                ", harvestImage='" + harvestImage + '\'' +
                '}';
    }
}
