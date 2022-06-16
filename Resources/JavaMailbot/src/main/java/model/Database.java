package model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final String connectionURL =
            "jdbc:oracle:thin:@localhost:1521:XE";
    private static final String USER = "mailbot";
    private static final String PASSWORD = "MAILBOT";
    private static Connection connection = null;

    private Database() {
    }

    public static Connection getConnection() throws SQLException {
        if (connection == null)
            createConnection();
        return connection;
    }

    private static void createConnection() {
        try {
            connection = DriverManager.getConnection(connectionURL, USER, PASSWORD);
            connection.setAutoCommit(false);
        } catch (SQLException e) {
            System.err.println(e);
        }
    }

    public static void closeConnection() {
        try {
            if (connection != null) {
                connection.close();
                connection = null;
            }
        } catch (SQLException e) {
            System.err.println(e);
        }
    }
}