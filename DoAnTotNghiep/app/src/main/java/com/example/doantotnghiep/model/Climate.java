package com.example.doantotnghiep.model;

public class Climate {
    String date;
    String temperature;
    String humidity;

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTemperature() {
        return temperature;
    }

    public void setTemperature(String temperature) {
        this.temperature = temperature;
    }

    public String getHumidity() {
        return humidity;
    }

    public void setHumidity(String humidity) {
        this.humidity = humidity;
    }

    public Climate() {
    }

    public Climate(String date, String temperature, String humidity) {
        this.date = date;
        this.temperature = temperature;
        this.humidity = humidity;
    }
}
