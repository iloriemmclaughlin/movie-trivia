<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207164014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT NOT NULL, user_id_id INT NOT NULL, game_id INT NOT NULL, total_questions INT NOT NULL, score INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C9D86650F ON game (user_id_id)');
        $this->addSql('CREATE TABLE game_question (id INT NOT NULL, game_id_id INT NOT NULL, question_id_id INT NOT NULL, game_question_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1DB3B6684D77E7D8 ON game_question (game_id_id)');
        $this->addSql('CREATE INDEX IDX_1DB3B6684FAF8F53 ON game_question (question_id_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, question_type_id_id INT NOT NULL, question_id INT NOT NULL, question_text TEXT NOT NULL, question_answer TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E169C8628 ON question (question_type_id_id)');
        $this->addSql('CREATE TABLE question_option (id INT NOT NULL, question_id_id INT NOT NULL, question_option_id INT NOT NULL, option_one TEXT NOT NULL, option_two TEXT NOT NULL, option_three TEXT NOT NULL, option_four TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5DDB2FB84FAF8F53 ON question_option (question_id_id)');
        $this->addSql('CREATE TABLE question_type (id INT NOT NULL, question_type_id INT NOT NULL, question_type TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE settings (id INT NOT NULL, user_id_id INT NOT NULL, settings_id INT NOT NULL, background_color TEXT NOT NULL, foreground_color TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E545A0C59D86650F ON settings (user_id_id)');
        $this->addSql('CREATE TABLE stats (id INT NOT NULL, user_id_id INT NOT NULL, stats_id INT NOT NULL, games_played INT DEFAULT NULL, high_score INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_574767AA9D86650F ON stats (user_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, user_type_id_id INT NOT NULL, user_id INT NOT NULL, first_name TEXT NOT NULL, last_name TEXT NOT NULL, email TEXT NOT NULL, username TEXT NOT NULL, password TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649D62FDF4C ON "user" (user_type_id_id)');
        $this->addSql('CREATE TABLE user_type (id INT NOT NULL, user_type_id INT NOT NULL, user_type TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B6684D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT FK_1DB3B6684FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E169C8628 FOREIGN KEY (question_type_id_id) REFERENCES question_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_option ADD CONSTRAINT FK_5DDB2FB84FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT FK_E545A0C59D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AA9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D62FDF4C FOREIGN KEY (user_type_id_id) REFERENCES user_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C9D86650F');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B6684D77E7D8');
        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B6684FAF8F53');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E169C8628');
        $this->addSql('ALTER TABLE question_option DROP CONSTRAINT FK_5DDB2FB84FAF8F53');
        $this->addSql('ALTER TABLE settings DROP CONSTRAINT FK_E545A0C59D86650F');
        $this->addSql('ALTER TABLE stats DROP CONSTRAINT FK_574767AA9D86650F');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D62FDF4C');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_question');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_option');
        $this->addSql('DROP TABLE question_type');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE stats');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
