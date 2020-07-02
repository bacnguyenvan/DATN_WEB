package com.example.doantotnghiep.constant;

public class UrlConstant {
    private static final String domain = "smarttrangtrai.com";
    public static final String urlAllFarm = String.format("http://%s/api/danh-sach-trang-trai", domain);
    public static final String urlImageFarm = String.format("http://%s/images/avatar/", domain);

    public static final String urlAllVegetaleOfFarm = String.format("http://%s/api/danh-sach-cay-trong-cua-trang-trai/", domain);
    public static final String urlDetailVegetale = String.format("http://%s/api/chi-tiet-cay-trong-thu-hoach/", domain);
    public static final String urlImageVegetale = String.format("http://%s/images/harvest/", domain);


}
