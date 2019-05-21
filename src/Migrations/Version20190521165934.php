<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190521165934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE factor_critico_de_exito (id INT AUTO_INCREMENT NOT NULL, binomio_id INT DEFAULT NULL, alta DATETIME DEFAULT NULL, baja DATETIME DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_753784AEA4CAF78E (binomio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE binomio_aspecte_q (binomio_id INT NOT NULL, aspecte_q_id INT NOT NULL, INDEX IDX_3B7BFE1CA4CAF78E (binomio_id), INDEX IDX_3B7BFE1CA1E5DDC1 (aspecte_q_id), PRIMARY KEY(binomio_id, aspecte_q_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factor_critico_de_exito ADD CONSTRAINT FK_753784AEA4CAF78E FOREIGN KEY (binomio_id) REFERENCES binomio (id)');
        $this->addSql('ALTER TABLE binomio_aspecte_q ADD CONSTRAINT FK_3B7BFE1CA4CAF78E FOREIGN KEY (binomio_id) REFERENCES binomio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE binomio_aspecte_q ADD CONSTRAINT FK_3B7BFE1CA1E5DDC1 FOREIGN KEY (aspecte_q_id) REFERENCES aspecte_q (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54861C8D0B');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54A6B6EE63');
        $this->addSql('DROP INDEX IDX_556D6A54A6B6EE63 ON aspecte_q');
        $this->addSql('DROP INDEX IDX_556D6A54861C8D0B ON aspecte_q');
        $this->addSql('ALTER TABLE aspecte_q ADD cuestiones_externas_id INT DEFAULT NULL, ADD cuestiones_internas_id INT DEFAULT NULL, DROP questions_externes_id, DROP questions_internes_id');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54DC2A6589 FOREIGN KEY (cuestiones_externas_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54FC8006E1 FOREIGN KEY (cuestiones_internas_id) REFERENCES questions_internes (id)');
        $this->addSql('CREATE INDEX IDX_556D6A54DC2A6589 ON aspecte_q (cuestiones_externas_id)');
        $this->addSql('CREATE INDEX IDX_556D6A54FC8006E1 ON aspecte_q (cuestiones_internas_id)');
        $this->addSql('ALTER TABLE binomio DROP FOREIGN KEY FK_C2C4060D730D4C8D');
        $this->addSql('ALTER TABLE binomio DROP FOREIGN KEY FK_C2C4060DB6EB97F8');
        $this->addSql('DROP INDEX IDX_C2C4060D730D4C8D ON binomio');
        $this->addSql('DROP INDEX IDX_C2C4060DB6EB97F8 ON binomio');
        $this->addSql('ALTER TABLE binomio DROP question_interna_id, DROP question_externa_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE factor_critico_de_exito');
        $this->addSql('DROP TABLE binomio_aspecte_q');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54DC2A6589');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54FC8006E1');
        $this->addSql('DROP INDEX IDX_556D6A54DC2A6589 ON aspecte_q');
        $this->addSql('DROP INDEX IDX_556D6A54FC8006E1 ON aspecte_q');
        $this->addSql('ALTER TABLE aspecte_q ADD questions_externes_id INT DEFAULT NULL, ADD questions_internes_id INT DEFAULT NULL, DROP cuestiones_externas_id, DROP cuestiones_internas_id');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54861C8D0B FOREIGN KEY (questions_externes_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54A6B6EE63 FOREIGN KEY (questions_internes_id) REFERENCES questions_internes (id)');
        $this->addSql('CREATE INDEX IDX_556D6A54A6B6EE63 ON aspecte_q (questions_internes_id)');
        $this->addSql('CREATE INDEX IDX_556D6A54861C8D0B ON aspecte_q (questions_externes_id)');
        $this->addSql('ALTER TABLE binomio ADD question_interna_id INT DEFAULT NULL, ADD question_externa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060D730D4C8D FOREIGN KEY (question_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE binomio ADD CONSTRAINT FK_C2C4060DB6EB97F8 FOREIGN KEY (question_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('CREATE INDEX IDX_C2C4060D730D4C8D ON binomio (question_externa_id)');
        $this->addSql('CREATE INDEX IDX_C2C4060DB6EB97F8 ON binomio (question_interna_id)');
    }
}
