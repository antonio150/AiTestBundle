# 🤖 AiTestBundle – Générateur automatique de tests Symfony

**AiTestBundle** est un bundle Symfony qui permet de **générer automatiquement des tests PHPUnit** à partir de vos contrôleurs.  
Il analyse les méthodes publiques d’un contrôleur et crée un fichier de test fonctionnel prêt à être exécuté.

🎯 Objectif :  
➡️ Gagner du temps dans l’écriture des tests  
➡️ Standardiser les tests des contrôleurs  
➡️ Faciliter la détection d’erreurs dans les routes API

---

## 📦 Installation

Installe le bundle en mode développement :

```bash
composer require antonio/aitestbundle --dev
```
## 📦 Utilisation

Voici exemple commande pour tester un controller :

```bash
symfony console ai:test-controller App\Controller\ExempleController
```

Exemple de return:
```bash
Tests exécutés :
PHPUnit 11.5.46 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.12
Configuration: E:\Mes Projets\bible_navira_back\phpunit.dist.xml

..                                                                  2 / 2 (100%)

Time: 00:04.160, Memory: 34.00 MB

OK (2 tests, 2 assertions)
```