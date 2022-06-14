import javax.mail.*;
import java.util.Properties;

public class ConnectionProperties {
    private final String username;
    private final String password;
    private Session mailSession;
    private Store store;

    public ConnectionProperties(String username, String password) {
        this.username = username;
        this.password = password;
        connect();
    }

    public void connect() {
        Properties properties = new Properties();
        properties.put("mail.pop3s.host", "pop.gmail.com");
        properties.put("mail.smtp.host", "smtp.gmail.com");
        properties.put("mail.pop3s.port", "995");
        properties.put("mail.smtp.port", "587");
        properties.put("mail.pop3s.starttls.enable", "true");
        properties.put("mail.smtp.starttls.enable", "true");
        properties.put("mail.smtp.auth", "true");

        Authenticator auth = new Authenticator() {
            public PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(username, password);
            }
        };
        mailSession = Session.getDefaultInstance(properties, auth);

        try {
            store = mailSession.getStore("pop3s");
            store.connect();
        } catch (MessagingException e) {
            throw new IllegalStateException(e);
        }
    }

    public String getUsername() {
        return username;
    }

    public Session getMailSession() {
        return mailSession;
    }

    public Store getStore() {
        return store;
    }
}