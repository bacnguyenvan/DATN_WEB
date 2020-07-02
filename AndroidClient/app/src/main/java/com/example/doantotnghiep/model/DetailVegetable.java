package com.example.doantotnghiep.model;

import java.util.ArrayList;
import java.util.List;

public class DetailVegetable extends Vegetable{
    public String ngay_trong;
    public String ngay_thu_hoach;
    public List<Location> location = new ArrayList<>();
    public List<Procedure> procedure = new ArrayList<>();
}
