<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321141911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ALTER date TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER background_color DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER foreground_color DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER background_color SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER foreground_color SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER date TYPE DATE');
    }
}
