package controllers;

import model.Database;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class UnpublishedExpiredMailsDAO {
    public UnpublishedExpiredMailsDAO() {
        try (
                Connection con = Database.getConnection();
                Statement statement = con.createStatement();
                Statement stmt = con.createStatement()) {
            ResultSet rs = statement.executeQuery("SELECT content_email FROM usermails WHERE " +
                    "published=1 AND duration<=sysdate");
            while (rs.next()) {
                stmt.executeUpdate("DELETE FROM friendsmails WHERE content_email='" + rs.getString(1) + "'");
            }
            statement.executeUpdate("UPDATE usermails SET published=0 WHERE " +
                    "published=1 AND duration<=sysdate");
            con.commit();
            Database.closeConnection();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
