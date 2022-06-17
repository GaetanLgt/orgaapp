<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617135255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_evenement DROP FOREIGN KEY FK_5BB2BB29FD02F13');
        $this->addSql('ALTER TABLE materiel_evenement DROP FOREIGN KEY FK_30BE4981FD02F13');
        $this->addSql('ALTER TABLE groupe_evenement DROP FOREIGN KEY FK_5BB2BB297A45358C');
        $this->addSql('ALTER TABLE musicien_groupe DROP FOREIGN KEY FK_E25DB2CE7A45358C');
        $this->addSql('ALTER TABLE instrument_materiel DROP FOREIGN KEY FK_B97B1090CF11D9C');
        $this->addSql('ALTER TABLE musicien_instrument DROP FOREIGN KEY FK_EF2D818CCF11D9C');
        $this->addSql('ALTER TABLE instrument_materiel DROP FOREIGN KEY FK_B97B109016880AAF');
        $this->addSql('ALTER TABLE materiel_evenement DROP FOREIGN KEY FK_30BE498116880AAF');
        $this->addSql('ALTER TABLE musicien_groupe DROP FOREIGN KEY FK_E25DB2CE60A30C4A');
        $this->addSql('ALTER TABLE musicien_instrument DROP FOREIGN KEY FK_EF2D818C60A30C4A');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21BACD6074');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_evenement');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE instrument_materiel');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE materiel_evenement');
        $this->addSql('DROP TABLE musicien');
        $this->addSql('DROP TABLE musicien_groupe');
        $this->addSql('DROP TABLE musicien_instrument');
        $this->addSql('DROP TABLE style');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD username VARCHAR(255) NOT NULL, DROP pseudo, DROP role, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nb_day INT NOT NULL, begin_hour LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', ending_hour LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, place_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, place_location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, place_contact_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, place_contact_phone_number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, place_contact_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, balance_time TIME NOT NULL, indoor TINYINT(1) NOT NULL, INDEX IDX_B26681EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, style_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contact_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contact_phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contact_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, setup TIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, INDEX IDX_4B98C21A76ED395 (user_id), INDEX IDX_4B98C21BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groupe_evenement (id INT AUTO_INCREMENT NOT NULL, groupe_id INT NOT NULL, evenement_id INT NOT NULL, day INT NOT NULL, tduration TIME NOT NULL, running_order INT NOT NULL, INDEX IDX_5BB2BB297A45358C (groupe_id), INDEX IDX_5BB2BB29FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE instrument_materiel (instrument_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_B97B109016880AAF (materiel_id), INDEX IDX_B97B1090CF11D9C (instrument_id), PRIMARY KEY(instrument_id, materiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, state VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, in_stock TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materiel_evenement (materiel_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_30BE498116880AAF (materiel_id), INDEX IDX_30BE4981FD02F13 (evenement_id), PRIMARY KEY(materiel_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE musicien (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE musicien_groupe (musicien_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_E25DB2CE60A30C4A (musicien_id), INDEX IDX_E25DB2CE7A45358C (groupe_id), PRIMARY KEY(musicien_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE musicien_instrument (musicien_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_EF2D818C60A30C4A (musicien_id), INDEX IDX_EF2D818CCF11D9C (instrument_id), PRIMARY KEY(musicien_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, style_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe_evenement ADD CONSTRAINT FK_5BB2BB297A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE groupe_evenement ADD CONSTRAINT FK_5BB2BB29FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE instrument_materiel ADD CONSTRAINT FK_B97B109016880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instrument_materiel ADD CONSTRAINT FK_B97B1090CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiel_evenement ADD CONSTRAINT FK_30BE498116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiel_evenement ADD CONSTRAINT FK_30BE4981FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_groupe ADD CONSTRAINT FK_E25DB2CE60A30C4A FOREIGN KEY (musicien_id) REFERENCES musicien (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_groupe ADD CONSTRAINT FK_E25DB2CE7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_instrument ADD CONSTRAINT FK_EF2D818C60A30C4A FOREIGN KEY (musicien_id) REFERENCES musicien (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musicien_instrument ADD CONSTRAINT FK_EF2D818CCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON `user`');
        $this->addSql('ALTER TABLE `user` ADD role VARCHAR(255) NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL, CHANGE username pseudo VARCHAR(255) NOT NULL');
    }
}
