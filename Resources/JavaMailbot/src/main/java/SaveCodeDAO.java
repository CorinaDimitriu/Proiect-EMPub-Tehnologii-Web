import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class SaveCodeDAO {
    public SaveCodeDAO(String email, int verificationCode) {
        try (
                Connection con = Database.getConnection();
                PreparedStatement preparedStatement = con.prepareStatement(
                        "UPDATE users set verification_code=? WHERE email=?")) {
            preparedStatement.setInt(1, verificationCode);
            preparedStatement.setString(2, email);
            preparedStatement.executeUpdate();
            con.commit();
            Database.closeConnection();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
