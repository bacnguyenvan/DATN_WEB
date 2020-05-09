package com.example.loadimage;

public class Comic {
    String Image;
    String title;
    String author;
    String category;

    public Comic(String image, String title, String author, String category) {
        Image = image;
        this.title = title;
        this.author = author;
        this.category = category;
    }

    public String getImage() {
        return Image;
    }

    public void setImage(String image) {
        Image = image;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getAuthor() {
        return author;
    }

    public void setAuthor(String author) {
        this.author = author;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }
}
