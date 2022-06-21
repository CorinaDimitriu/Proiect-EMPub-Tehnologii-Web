package controllers;

import model.Database;

import java.sql.*;

public class SaveCodeDAO {
    public SaveCodeDAO(String email, String verificationCode) {
        if(existsMail(email)) {
            try (
                    Connection con = Database.getConnection();
                    PreparedStatement preparedStatement = con.prepareStatement(
                            "UPDATE users set verification_code=? WHERE email=?")) {
                preparedStatement.setString(1, verificationCode);
                preparedStatement.setString(2, email);
                preparedStatement.executeUpdate();
                con.commit();
                Database.closeConnection();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        else {
            try (
                    Connection con = Database.getConnection();
                    PreparedStatement preparedStatement = con.prepareStatement(
                            "INSERT INTO users(email,verification_code) VALUES(?,?)")) {
                preparedStatement.setString(1, email);
                preparedStatement.setString(2, verificationCode);
                preparedStatement.executeUpdate();
                con.commit();
                Database.closeConnection();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public SaveCodeDAO(){};

    public boolean existsMail(String mail) {
        try (
                Connection con = Database.getConnection();
                Statement stmt = con.createStatement()) {
            ResultSet rs = stmt.executeQuery("SELECT * FROM users WHERE email='" + mail +"'");
            boolean check = rs.next();
            Database.closeConnection();
            return check;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
}