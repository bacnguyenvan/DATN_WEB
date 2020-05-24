package com.example.doantotnghiep.constant;

public class AppConstant {
    private static final String domain = "192.168.1.107";
    public static final String urlAll = String.format("http://%s/do_an_tot_nghiep/admin/api/listVegetable.php", domain);
    public static final String urlDetail = String.format("http://%s/do_an_tot_nghiep/admin/api/vegetableById.php?id=", domain);
    public static final String urlImage = String.format("http://%s/do_an_tot_nghiep/admin/public/uploads/rau/", domain);
}
