<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209194120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE settings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stats_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game (
                                game_id INT NOT NULL, 
                                user_id INT NOT NULL, 
                                total_questions INT NOT NULL, 
                                score INT NOT NULL, 
                                date DATE NOT NULL, 
                                PRIMARY KEY(game_id))');
        $this->addSql('CREATE INDEX ix__game__user_id ON game (user_id)');
        $this->addSql('CREATE TABLE game_question (
                                game_question_id INT NOT NULL, 
                                game_id INT NOT NULL, 
                                question_id INT NOT NULL, 
                                user_answer TEXT DEFAULT NULL, 
                                PRIMARY KEY(game_question_id))');
        $this->addSql('CREATE INDEX ix__game_question__game_id ON game_question (game_id)');
        $this->addSql('CREATE INDEX ix__game_question__question_id ON game_question (question_id)');
        $this->addSql('CREATE TABLE question (
                                question_id INT NOT NULL, 
                                question_type_id INT NOT NULL, 
                                question_text TEXT NOT NULL, 
                                question_answer TEXT NOT NULL, 
                                PRIMARY KEY(question_id))');
        $this->addSql('CREATE INDEX ix__question__question_type_id ON question (question_type_id)');
        $this->addSql('CREATE TABLE question_option (
                                question_option_id INT NOT NULL, 
                                question_id INT NOT NULL, 
                                option TEXT NOT NULL, 
                                PRIMARY KEY(question_option_id))');
        $this->addSql('CREATE INDEX ix__question_option__question_id ON question_option (question_id)');
        $this->addSql('CREATE TABLE question_type (
                                question_type_id INT NOT NULL, 
                                question_type TEXT NOT NULL, 
                                PRIMARY KEY(question_type_id))');
        $this->addSql('CREATE TABLE settings (
                                settings_id INT NOT NULL, 
                                user_id INT NOT NULL, 
                                background_color TEXT NOT NULL, 
                                foreground_color TEXT NOT NULL, 
                                PRIMARY KEY(settings_id))');
        $this->addSql('CREATE UNIQUE INDEX ux__settings__user_id ON settings (user_id)');
        $this->addSql('CREATE TABLE stats (
                                stats_id INT NOT NULL, 
                                user_id INT NOT NULL, 
                                games_played INT DEFAULT NULL, 
                                high_score INT DEFAULT NULL, 
                                PRIMARY KEY(stats_id))');
        $this->addSql('CREATE UNIQUE INDEX ux__stats__user_id ON stats (user_id)');
        $this->addSql('CREATE TABLE "user" (
                                user_id INT NOT NULL, 
                                user_type_id INT NOT NULL, 
                                first_name TEXT NOT NULL, 
                                last_name TEXT NOT NULL, 
                                email TEXT UNIQUE NOT NULL, 
                                username TEXT UNIQUE NOT NULL, 
                                password TEXT NOT NULL, 
                                PRIMARY KEY(user_id))');
        $this->addSql('CREATE INDEX ix__user__user_type_id ON "user" (user_type_id)');
        $this->addSql('CREATE TABLE user_type (
                                user_type_id INT NOT NULL, 
                                user_type TEXT NOT NULL, 
                                PRIMARY KEY(user_type_id))');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk__user__game FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT fk__game__game_question FOREIGN KEY (game_id) REFERENCES game (game_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_question ADD CONSTRAINT fk__question__game_question FOREIGN KEY (question_id) REFERENCES question (question_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk__question_type__question FOREIGN KEY (question_type_id) REFERENCES question_type (question_type_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_option ADD CONSTRAINT fk__question__question_option FOREIGN KEY (question_id) REFERENCES question (question_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE settings ADD CONSTRAINT fk__user__settings FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT fk__user__stats FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk__user_type__user FOREIGN KEY (user_type_id) REFERENCES user_type (user_type_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE SCHEMA public');
//        $this->addSql('DROP SEQUENCE game_game_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE game_question_game_question_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE question_question_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE question_option_question_option_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE question_type_question_type_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE settings_settings_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE stats_stats_id_seq CASCADE');
//        $this->addSql('DROP SEQUENCE "user_user_id_seq" CASCADE');
//        $this->addSql('DROP SEQUENCE user_type_user_type_id_seq CASCADE');
//        $this->addSql('CREATE SEQUENCE user_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
//        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
//        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CA76ED395');
//        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B668E48FD905');
//        $this->addSql('ALTER TABLE game_question DROP CONSTRAINT FK_1DB3B6681E27F6BF');
//        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494ECB90598E');
//        $this->addSql('ALTER TABLE question_option DROP CONSTRAINT FK_5DDB2FB81E27F6BF');
//        $this->addSql('ALTER TABLE settings DROP CONSTRAINT FK_E545A0C5A76ED395');
//        $this->addSql('ALTER TABLE stats DROP CONSTRAINT FK_574767AAA76ED395');
//        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6499D419299');
//        $this->addSql('DROP TABLE game');
//        $this->addSql('DROP TABLE game_question');
//        $this->addSql('DROP TABLE question');
//        $this->addSql('DROP TABLE question_option');
//        $this->addSql('DROP TABLE question_type');
//        $this->addSql('DROP TABLE settings');
//        $this->addSql('DROP TABLE stats');
//        $this->addSql('DROP TABLE "user"');
//        $this->addSql('DROP TABLE user_type');
//        $this->addSql('DROP TABLE messenger_messages');
    }
}
