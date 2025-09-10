<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250905210711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP TABLE typejournal');
        $this->addSql('ALTER TABLE journal DROP FOREIGN KEY `FK_journal_motif`');
        $this->addSql('ALTER TABLE journal CHANGE libelle_id libelle_id INT NOT NULL, CHANGE type_journal type_journal VARCHAR(100) NOT NULL, CHANGE montant montant NUMERIC(15, 4) NOT NULL, CHANGE commentaire commentaire LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74D25DD318D FOREIGN KEY (libelle_id) REFERENCES motif (id)');
        $this->addSql('ALTER TABLE journal RENAME INDEX fk_journal_motif TO IDX_C1A7E74D25DD318D');
        $this->addSql('ALTER TABLE motif CHANGE raison raison VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE typejournal (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'0\' NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE journal DROP FOREIGN KEY FK_C1A7E74D25DD318D');
        $this->addSql('ALTER TABLE journal CHANGE montant montant NUMERIC(15, 2) DEFAULT \'0.00\' NOT NULL, CHANGE type_journal type_journal VARCHAR(100) DEFAULT \'0\' NOT NULL, CHANGE commentaire commentaire TEXT DEFAULT NULL, CHANGE libelle_id libelle_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT `FK_journal_motif` FOREIGN KEY (libelle_id) REFERENCES motif (id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE journal RENAME INDEX idx_c1a7e74d25dd318d TO FK_journal_motif');
        $this->addSql('ALTER TABLE motif CHANGE raison raison VARCHAR(255) DEFAULT \'0\' NOT NULL');
    }
}
