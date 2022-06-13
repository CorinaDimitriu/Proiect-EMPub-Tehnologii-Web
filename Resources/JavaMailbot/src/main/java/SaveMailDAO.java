import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.sql.*;

public class SaveMailDAO {

    public static void saveInDatabase(String email, String subject, String content) throws IOException
    {
        int numberOfEmails = countEmails(email) + 1;
        try (
                Connection con = Database.getConnection();
                PreparedStatement preparedStatement = con.prepareStatement(
                        "INSERT INTO usermails VALUES(?,?,?,0)")) {
            preparedStatement.setString(1, email);
            preparedStatement.setString(2, subject);
            Path path = Paths.get("./DownloadedMails");
            if (!Files.exists(path))
                Files.createDirectory(path);
            BufferedWriter output = null;
            File file = new File("./DownloadedMails/" + email + "_" + numberOfEmails + ".html");
            output = new BufferedWriter(new FileWriter(file));
            output.write(content);
            output.flush();
            output.close();
            preparedStatement.setString(3, file.getPath());
            preparedStatement.executeUpdate();
            con.commit();
            Database.closeConnection();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public static int countEmails(String email) {
        try (Connection con = Database.getConnection()) {
            Statement stmt = con.createStatement();
            ResultSet rs = stmt.executeQuery("select count(*) from usermails where user_email='" + email + "'");
            int result = rs.next() ? rs.getInt(1) : null;
            Database.closeConnection();
            return result;
        } catch (SQLException e) {
            e.printStackTrace();
            return 0;
        }
    }
}
