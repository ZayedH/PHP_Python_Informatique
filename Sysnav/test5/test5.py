
import sys 

def start_S(grid):
    ''' This function returns a tuple (i,j),where grid[i][j]=="S" '''
    n=len(grid)      #number of lignes 
    m=len(grid[0])   #number of columns

    for i in range(n):
        for j in range(m):
            if(grid[i][j]=="S"):
                return (i,j)         #on suppose l'unicité et l'existance de "S"


def  neighbours(start):
    ''' returns the neighbors of the point start'''
    i=start[0]
    j=start[1]
                               
    return ((i+1,j),(i-1,j),(i,j+1),(i,j-1))    # dans cet ordre de choix,l'algorithme préfère les déplacements  dans l'ordre suivant ("D","U","R","L")

def direction(neighbour,start):
    ''' returns the direction of the next step ,ones we are in start.
    "R" for right, "U" for "Up","D" for "down", "L" for "left" '''
    if(neighbour[0]==start[0]): #left or right 
        
        if(neighbour[1]>start[1]):
            return "R"
        else:
            return "L"
    else:     # Up or Down
        if(neighbour[0]>start[0]):
            return "D"
        else:
            return "U"

       

def show(grid ,start):
     ''' returns the  value of start in the grid structure'''
     i=start[0]
     j=start[1]

     return grid[i][j]
    
def markVisited(grid,start,mark):
    start_i=start[0]
    start_j=start[1]
    if(show(grid,start)=="S" or show(grid,start)=="E" ) :
        mark=show(grid,start)
    grid[start_i]=grid[start_i][:start_j]+mark+grid[start_i][start_j+1:] #on la marque désormais comme ayant été explorée
    
    return
    

    


def isVisited(grid,start):
       
     '''returns a boolean  to indicate if start has already been visited during the Depth-first search'''

     return show(grid,start)=="V" or show(grid,start)=="S"


def isTree(grid,start):
     ''' returns a boolean  to indicate if start is a tree, so we backtrack'''
    

     return show(grid,start)=="#"

def isBruler(grid,start):
    ''' returns a boolean  to indicate if start is a danger point, so we backtrack'''
    ''' a danger point is neighbour of "F" '''

    voisins=neighbours(start)

    for neighbour in voisins:

        if(show(grid,neighbour)=="F"):
            return True
    return False









def findPath(grid,path,start):
   

   

     

    if(show(grid,start)=="E"):
        
        return True             # there is a solution for this problem

   
    markVisited(grid,start,"V") #on la marque désormais comme ayant été explorée

    for neighbour in neighbours(start):
        
        if((not(isVisited(grid,neighbour))) and (not(isTree(grid,neighbour))))and (not(isBruler(grid,neighbour)) and findPath(grid,path,neighbour) ):
            step=direction(neighbour,start)
            markVisited(grid,neighbour,step)

            path[0]=step+ path[0]  # le chemin
            return True
    
  
    return False   # there is no solution for this problem


         
    
def solutionGrid(gridePath):
    ''' returns the path from "S" to "E" '''
    try:
      file=open(gridePath[1],"r")
      grid=file.readlines()
      file.close()

      path=[""]
   
      if(findPath(grid,path,start_S(grid))):
       print(path[0])
       for ligne in grid:
          print(ligne)              # pour afficher la trajectoire obtenue, dans le grid 
       
       
      else:
          sys.exit(1)

    except SystemExit:
        
        sys.exit(1)

    except:
        print("An unexpected error occurred") 
        sys.exit(1)
       
        

    



gridePath=sys.argv

solutionGrid(gridePath)


