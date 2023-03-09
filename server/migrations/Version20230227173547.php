<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227173547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('DROP SEQUENCE settings_settings_id_seq CASCADE');
        //$this->addSql('ALTER TABLE settings DROP CONSTRAINT fk_e545a0c5a76ed395');
        //$this->addSql('DROP TABLE settings');
        $this->addSql('ALTER TABLE "user" ADD background_color TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD foreground_color TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE SCHEMA public');
//        $this->addSql('CREATE SEQUENCE settings_settings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
//        $this->addSql('CREATE TABLE settings (settings_id INT NOT NULL, user_id INT NOT NULL, background_color TEXT NOT NULL, foreground_color TEXT NOT NULL, PRIMARY KEY(settings_id))');
//        $this->addSql('CREATE UNIQUE INDEX uniq_e545a0c5a76ed395 ON settings (user_id)');
//        $this->addSql('ALTER TABLE settings ADD CONSTRAINT fk_e545a0c5a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
//        $this->addSql('ALTER TABLE "user" DROP background_color');
//        $this->addSql('ALTER TABLE "user" DROP foreground_color');
    }
}
