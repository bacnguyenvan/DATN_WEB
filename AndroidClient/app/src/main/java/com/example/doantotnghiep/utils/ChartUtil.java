package com.example.doantotnghiep.utils;

import android.graphics.Color;

import com.github.mikephil.charting.charts.BarChart;
import com.github.mikephil.charting.components.XAxis;
import com.github.mikephil.charting.components.YAxis;
import com.github.mikephil.charting.data.BarData;
import com.github.mikephil.charting.data.BarDataSet;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.formatter.IndexAxisValueFormatter;
import com.github.mikephil.charting.formatter.LargeValueFormatter;

import java.util.List;

public class ChartUtil {

    public static void drawBarChart(BarChart barChart, List<BarEntry> column1,
                                    List<BarEntry> column2, List<String> dates,
                                    String titleColumn1, String titleColumn2){
        BarDataSet barTemperature = new BarDataSet(column1,titleColumn1);
        barTemperature.setValueTextSize(10);
        barTemperature.setColor(Color.parseColor("#F9A41A"));
        BarDataSet barHumidity = new BarDataSet(column2,titleColumn2);
        barHumidity.setValueTextSize(10);
        barHumidity.setColor(Color.parseColor("#57B657"));
        BarData barData = new BarData(barTemperature,barHumidity);
        barChart.setBackgroundColor(Color.WHITE);
        barChart.setDescription(null);
        barChart.setData(barData);
        String[] date = new String[dates.size()];
        for(int i = 0; i < dates.size();i++)
            date[i] = dates.get(i);
        float barWidth;
        float barSpace;
        float groupSpace;

        barWidth = 0.32f;
        barSpace = 0.0f;
        groupSpace = 0.36f;
        XAxis xAxis = barChart.getXAxis();
        xAxis.setGranularity(1f);
        xAxis.setGranularityEnabled(true);
        xAxis.setCenterAxisLabels(true);
        xAxis.setDrawGridLines(false);

        xAxis.setPosition(XAxis.XAxisPosition.BOTTOM);
        xAxis.setValueFormatter(new IndexAxisValueFormatter(date));
        YAxis leftAxis = barChart.getAxisLeft();
        leftAxis.setValueFormatter(new LargeValueFormatter());
        leftAxis.setDrawGridLines(true);

        int groupCount = dates.size();
        barChart.getBarData().setBarWidth(barWidth);
        barChart.getXAxis().setAxisMinimum(0);
        barChart.getXAxis().setAxisMaximum(barWidth + barChart.getBarData().getGroupWidth(groupSpace, barSpace) * groupCount);
        barChart.groupBars(0, groupSpace, barSpace);
        barChart.getData().setHighlightEnabled(false);
        barChart.setVisibleXRangeMaximum(5);
        barChart.invalidate();
    }
}
