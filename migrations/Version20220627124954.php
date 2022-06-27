<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627124954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band ADD style_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE band ADD CONSTRAINT FK_48DFA2EBBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE band ADD CONSTRAINT FK_48DFA2EBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_48DFA2EBBACD6074 ON band (style_id)');
        $this->addSql('CREATE INDEX IDX_48DFA2EBA76ED395 ON band (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band DROP FOREIGN KEY FK_48DFA2EBBACD6074');
        $this->addSql('ALTER TABLE band DROP FOREIGN KEY FK_48DFA2EBA76ED395');
        $this->addSql('DROP INDEX IDX_48DFA2EBBACD6074 ON band');
        $this->addSql('DROP INDEX IDX_48DFA2EBA76ED395 ON band');
        $this->addSql('ALTER TABLE band DROP style_id, DROP user_id');
    }
}
