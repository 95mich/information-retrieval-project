/*
* query-tools.h
*
* Author: Taufik F. Abidin
*
*/


/* struct for loading data from file vocabulary (fvoc) */
typedef struct term
{
  char *term;
  int   len;
  int   offset;
}Term;


/* struct of heap */
typedef struct heap
{
  long int docno;
  double ranked;
}Heap;


/* struct for accumulator */
typedef struct accumulator
{
  unsigned long docno;
  float ranked;
}Accu;


/* struct for holding docno, doclen and offset. The offset
   is required to retrieve file name in file data.nme */
typedef struct fileinfo
{
  long int docno;
  long int doclen;
  long int offset;
}FileInfo;

struct entry_s {
	char *key;
	char *value;
	char *value1;
	struct entry_s *next;
};

typedef struct entry_s entry_t;

struct hashtable_s {
	int size;
	struct entry_s **table;	
};

typedef struct hashtable_s hashtable_t;


/* functions implemented in query-tools.c */
int buildHeap(Heap *, int, unsigned long, double);
int adjustHeap(Heap *, int, int);
hashtable_t *ht_create( int size );
int ht_hash( hashtable_t *hashtable, char *key );
entry_t *ht_newpair( char *key, char *value, char *value1 );
void ht_set( hashtable_t *hashtable, char *key, char *value, char *value1 );
char *ht_get( hashtable_t *hashtable, char *key );
char *ht_get1( hashtable_t *hashtable, char *key );
void searchTerm2(char *query);
