<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713145532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE musicien_band (id INT AUTO_INCREMENT NOT NULL, musicien_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, band_id INT DEFAULT NULL, INDEX IDX_22923F7A60A30C4A (musicien_id), INDEX IDX_22923F7ACF11D9C (instrument_id), INDEX IDX_22923F7A49ABEB17 (band_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE musicien_band ADD CONSTRAINT FK_22923F7A60A30C4A FOREIGN KEY (musicien_id) REFERENCES musicien (id)');
        $this->addSql('ALTER TABLE musicien_band ADD CONSTRAINT FK_22923F7ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE musicien_band ADD CONSTRAINT FK_22923F7A49ABEB17 FOREIGN KEY (band_id) REFERENCES band (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE musicien_band');
    }
}
