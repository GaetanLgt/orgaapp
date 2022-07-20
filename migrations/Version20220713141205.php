<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713141205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band DROP FOREIGN KEY FK_48DFA2EBA76ED395');
        $this->addSql('ALTER TABLE band CHANGE style_id style_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE band ADD CONSTRAINT FK_48DFA2EBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE materiel DROP status, CHANGE health_id health_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel_evenement DROP FOREIGN KEY FK_30BE498116880AAF');
        $this->addSql('ALTER TABLE materiel_evenement ADD CONSTRAINT FK_30BE498116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band DROP FOREIGN KEY FK_48DFA2EBA76ED395');
        $this->addSql('ALTER TABLE band CHANGE style_id style_id INT NOT NULL');
        $this->addSql('ALTER TABLE band ADD CONSTRAINT FK_48DFA2EBA76ED395 FOREIGN KEY (user_id) REFERENCES band (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE materiel ADD status VARCHAR(255) NOT NULL, CHANGE health_id health_id INT NOT NULL, CHANGE categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE materiel_evenement DROP FOREIGN KEY FK_30BE498116880AAF');
        $this->addSql('ALTER TABLE materiel_evenement ADD CONSTRAINT FK_30BE498116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
