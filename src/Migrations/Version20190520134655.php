<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520134655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE aspecte_q (id INT AUTO_INCREMENT NOT NULL, questions_externes_id INT DEFAULT NULL, questions_internes_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, dafo VARCHAR(255) NOT NULL, alta DATETIME NOT NULL, baixa DATETIME NOT NULL, descripcio VARCHAR(255) NOT NULL, INDEX IDX_556D6A54861C8D0B (questions_externes_id), INDEX IDX_556D6A54A6B6EE63 (questions_internes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54861C8D0B FOREIGN KEY (questions_externes_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54A6B6EE63 FOREIGN KEY (questions_internes_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE questions_internes ADD empresa_id INT DEFAULT NULL, ADD centro_id INT DEFAULT NULL, ADD corporacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757298137A7 FOREIGN KEY (centro_id) REFERENCES centro (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E337571011F129 FOREIGN KEY (corporacion_id) REFERENCES corporacion (id)');
        $this->addSql('CREATE INDEX IDX_90E33757521E1991 ON questions_internes (empresa_id)');
        $this->addSql('CREATE INDEX IDX_90E33757298137A7 ON questions_internes (centro_id)');
        $this->addSql('CREATE INDEX IDX_90E337571011F129 ON questions_internes (corporacion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE aspecte_q');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757521E1991');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757298137A7');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E337571011F129');
        $this->addSql('DROP INDEX IDX_90E33757521E1991 ON questions_internes');
        $this->addSql('DROP INDEX IDX_90E33757298137A7 ON questions_internes');
        $this->addSql('DROP INDEX IDX_90E337571011F129 ON questions_internes');
        $this->addSql('ALTER TABLE questions_internes DROP empresa_id, DROP centro_id, DROP corporacion_id');
    }
}
