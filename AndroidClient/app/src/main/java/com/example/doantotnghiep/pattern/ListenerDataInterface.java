package com.example.doantotnghiep.pattern;

import com.example.doantotnghiep.model.Vegetable;

import java.util.List;

public interface ListenerDataInterface {
    void notifyDataGetSuccess(List<? extends Vegetable> obj);
}
