<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314151329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stats DROP CONSTRAINT fk_574767aaa76ed395');
        $this->addSql('DROP INDEX uniq_574767aaa76ed395');
        $this->addSql('ALTER TABLE stats ADD username TEXT NOT NULL');
        $this->addSql('ALTER TABLE stats DROP user_id');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT FK_574767AAF85E0677 FOREIGN KEY (username) REFERENCES "user" (username) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_574767AAF85E0677 ON stats (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER background_color SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER foreground_color SET NOT NULL');
        $this->addSql('ALTER TABLE stats DROP CONSTRAINT FK_574767AAF85E0677');
        $this->addSql('DROP INDEX UNIQ_574767AAF85E0677');
        $this->addSql('ALTER TABLE stats ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE stats DROP username');
        $this->addSql('ALTER TABLE stats ADD CONSTRAINT fk_574767aaa76ed395 FOREIGN KEY (user_id) REFERENCES "user" (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_574767aaa76ed395 ON stats (user_id)');
    }
}
