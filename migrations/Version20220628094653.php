<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628094653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand_planning (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, planning_id INT NOT NULL, temps_de_passage TIME NOT NULL, ordre_de_passage INT NOT NULL, jour_de_passage INT NOT NULL, INDEX IDX_13A92CE744F5D008 (brand_id), INDEX IDX_13A92CE73D865311 (planning_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brand_planning ADD CONSTRAINT FK_13A92CE744F5D008 FOREIGN KEY (brand_id) REFERENCES band (id)');
        $this->addSql('ALTER TABLE brand_planning ADD CONSTRAINT FK_13A92CE73D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE brand_planning');
    }
}
