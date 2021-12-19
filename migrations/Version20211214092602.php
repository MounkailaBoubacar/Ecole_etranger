<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214092602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, coefficient VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluation ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_1323A575F46CD258 ON evaluation (matiere_id)');
        $this->addSql('ALTER TABLE user ADD classe_id INT DEFAULT NULL, ADD matiere_enseigner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649324DA8E7 FOREIGN KEY (matiere_enseigner_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5EA509 ON user (classe_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649324DA8E7 ON user (matiere_enseigner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575F46CD258');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649324DA8E7');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP INDEX IDX_1323A575F46CD258 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP matiere_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('DROP INDEX IDX_8D93D6498F5EA509 ON `user`');
        $this->addSql('DROP INDEX UNIQ_8D93D649324DA8E7 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP classe_id, DROP matiere_enseigner_id');
    }
}
