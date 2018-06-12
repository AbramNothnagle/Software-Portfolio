//============================================================================
// Name        : Polygons.cpp
// Author      : Abram Nothnagle
// Version     : 1
// Description : Performs polygon mathematics to determine angles on a given polygon with given parameters
//============================================================================

#include <iostream>
#include <cmath>
using namespace std;

#define Pi 3.14159

class Polygons{
public:
	int angles(int);
	double parallelogram(double, double, double);
	double knownTrapezoid(double,double,double);
};

int Polygons::angles(int sides){
	int angleSum = 0;
	angleSum = (sides-2)*180;
	return angleSum;
}

double Polygons::parallelogram(double len1, double len2, double angle){
	double smallAngle = 0;
	double area;
	bool skip = false;
	if (angle > 90){
		smallAngle = 180-angle;
	}
	else if(angle < 90){
		smallAngle = angle;
	}
	else if (angle == 90){
		area = len1*len2;
		skip = true;
	}
	if (!skip){
		area = len2*sin(smallAngle*Pi/180)*len1;
	}
	return area;
}

double Polygons::knownTrapezoid(double b1, double b2, double h){
	double area = 0;
	area = 0.5*h*(b1+b2);
	return area;
}

int main() {
	cout << "Options: \n"<<"Enter 1 for interior angle sum\n"<<"Enter 2 for the area of a parallelogram\n"<<
			"Enter 3 for the area of a trapezoid with known bases and height\n"<<endl;
	int choice = 0;
	cin >> choice;
	Polygons polygon;
	if (choice == 1){
		int sides;
		cout << "Enter the number of sides this polygon has"<<endl;
		cin >> sides;
		cout << polygon.angles(sides);
	}
	if (choice == 2){
		double parallelogramLen1 = 0;
		double parallelogramLen2 = 0;
		double parallelogramAngle = 0;
		cout <<"Enter the two different side lengths and one of the angles.\n";
		cout << "Side length 1: ";
		cin >> parallelogramLen1;
		cout << "Side length 2: ";
		cin >> parallelogramLen2;
		cout << "One angle in degrees: ";
		cin >> parallelogramAngle;
		cout << polygon.parallelogram(parallelogramLen1, parallelogramLen2, parallelogramAngle);
	}
	if (choice == 3){
		cout << "Enter the two bases and the height\n";
		cout << "Enter the first base: ";
		double base1;
		cin >> base1;
		cout << "Enter the second base: ";
		double base2;
		cin >> base2;
		cout << "Enter the height: ";
		double height;
		cin >> height;
		cout << polygon.knownTrapezoid(base1, base2, height);
	}
	return 0;
}
