<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628100112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE band_planning (id INT AUTO_INCREMENT NOT NULL, band_id INT NOT NULL, planning_id INT NOT NULL, temps_de_passage TIME NOT NULL, ordre_de_passage INT NOT NULL, jour_de_passage INT NOT NULL, INDEX IDX_14D2FEFC49ABEB17 (band_id), INDEX IDX_14D2FEFC3D865311 (planning_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE band_planning ADD CONSTRAINT FK_14D2FEFC49ABEB17 FOREIGN KEY (band_id) REFERENCES band (id)');
        $this->addSql('ALTER TABLE band_planning ADD CONSTRAINT FK_14D2FEFC3D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE band_planning');
    }
}
