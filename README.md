# php-schatzsuche
Einfaches PHP-Script für eine Schatzsuche am Kindergeburtstag oder eine einfache GPS-Ralley.

Dabei erhält die (Kinder-)Gruppe ein Smartphone/Tablet und entweder Rätsel vor Ort oder Fragen zu örtlichen Gegebenheiten. 

Jeder Schritt besteht aus einer Frage, einer richtigen Antwort und einem Hinweis auf den Ort des nächsten Schritts (als Text, Bild und/oder Geo-Koordinaten).

Die Fragen sollten so gestellt werden, dass man am richtigen Ort sein muss um diese zu beantworten (z.B. "Wie viele Stufen hat die Treppe?") oder dass am aktuellen Ort ein Rätsel versteckt ist.

Das Eingabefeld für die Antwort wird bei numerischen Antworten auf numeirsche Eingabe gesetzt, bei allem anderen auf Freitext-Eingabe. Als richtige Antwort kann ein Array hinterlegt werden, wenn mehrere Antworten gültig sind (per default wird case-insensitiv geprüft).

Für den letzten Schritt ist eine Sonderlogik eingebaut, damit ein Abschlusstext angezeigt werden kann. Siehe Beispiel in schritte.php

